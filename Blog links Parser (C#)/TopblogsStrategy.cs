using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Text.RegularExpressions;

namespace SeoParser
{
    class TopblogsStrategy : IStrategy
    {
        public List<string> Parse(string url)
        {
            List<string> result = new List<string>();

            for (int page = 1; ; page++)
            {
                string text = Http.Download(url + page + "/");

                var regexMatches = Regex.Matches(text, "<td class=\"tb_name\"><a href=\"(?<1>.+?)\"", RegexOptions.IgnoreCase);
                
                if (regexMatches.Count == 0)
                {
                    break;
                }

                foreach (Match match in regexMatches)
                {
                    result.Add(match.Groups[1].Value);
                }
            }

            return result;
        }
    }
}
