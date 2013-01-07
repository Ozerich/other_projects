using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Text.RegularExpressions;

namespace SeoParser
{
    class EpochtaStrategy : IStrategy
    {
        public List<string> Parse(string url)
        {
            List<string> result = new List<string>();

            string text = Http.Download(url + "perpage/10000/");

            foreach (Match match in Regex.Matches(text, "<td class=\"pos\">(.|\n)+?<\\!--<a href=\"(?<1>.+?)\"", RegexOptions.IgnoreCase))
            {
                result.Add(match.Groups[1].Value);
            }

            return result;
        }
    }
}
